/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strnew.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/08 11:54:02 by bclerc            #+#    #+#             */
/*   Updated: 2018/11/13 17:26:16 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <stdlib.h>
#include "libft.h"

char	*ft_strnew(size_t size)
{
	char *ptr;

	if ((ptr = (char*)malloc((size + 1) * sizeof(char))) == NULL)
		return (0);
	ft_bzero(ptr, size);
	ptr[size] = '\0';
	return (ptr);
}
