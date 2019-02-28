/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strtrim.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/08 18:31:44 by bclerc            #+#    #+#             */
/*   Updated: 2018/11/23 15:09:54 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static	int		is_blanks(char c)
{
	return (c == ' ' || c == '\n' || c == '\t');
}

char			*ft_strtrim(char const *s)
{
	char	*rt;
	int		begin;
	int		end;

	if (!s)
		return (NULL);
	begin = 0;
	end = ft_strlen((char*)s) - 1;
	while (s[begin] && is_blanks(s[begin]))
		begin++;
	if (!s[begin])
		return (ft_strdup(&s[begin]));
	while (end > 0 && is_blanks(s[end]))
		end--;
	if ((rt = ft_strsub(s, begin, (end - begin) + 1)) == NULL)
		return (NULL);
	return (rt);
}
