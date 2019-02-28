/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strmap.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/08 14:30:12 by bclerc            #+#    #+#             */
/*   Updated: 2018/11/11 11:01:53 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <stdlib.h>
#include "libft.h"

char	*ft_strmap(char const *s, char (*f)(char))
{
	int			i;
	int			len;
	char		*tmp;

	if (!s)
		return (NULL);
	len = ft_strlen((char *)s);
	if ((tmp = (char*)malloc((len + 1) * sizeof(char))) == NULL)
		return (NULL);
	i = 0;
	while (s[i])
	{
		tmp[i] = (*f)(s[i]);
		i++;
	}
	tmp[i] = '\0';
	return (tmp);
}
