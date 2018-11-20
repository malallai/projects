/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strjoin.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/12 12:06:33 by malallai          #+#    #+#             */
/*   Updated: 2018/11/20 12:49:39 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

char	*ft_strjoin(char const *s1, char const *s2)
{
	char	*new;
	int		size;
	char	n;

	n = '\0';
	if (!s1)
		s1 = &n;
	if (!s2)
		s2 = &n;
	size = ft_strlen(s1) + ft_strlen(s2);
	if (!(new = ft_strnew(size)))
		return (NULL);
	ft_strcpy(new, s1);
	ft_strcpy(new + ft_strlen(s1), s2);
	return (new);
}
